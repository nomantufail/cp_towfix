<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\NewsletterImagesRepository;
use App\Repositories\NewslettersRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class NewslettersController extends ParentController
{
    private $newsletters = null;
    private $newsletterImages = null;
    public function __construct(NewslettersRepository $newslettersRepository, NewsletterImagesRepository $newsletterImagesRepository)
    {
        parent::__construct();
        $this->newsletters = $newslettersRepository;
        $this->newsletterImages = $newsletterImagesRepository;
    }

    public function showNewsletters(Requests\Newsletter\ViewNewslettersRequest $request)
    {

        $newsletters = $this->newsletters->getWithDetails();
        if(Auth::user()->isCustomer()){
            return view('newsletters.customer-newsletters', ['newsletters'=>$newsletters]);
        }else{
            return view('newsletters.admin-newsletters', ['newsletters'=>$newsletters]);
        }
    }

    public function showAddNewsletterForm(Requests\Newsletter\ShowAddNewsletterFormRequest $request)
    {
        return view('newsletters.add-newsletter');
    }

    public function newsletterDetail(Requests\Newsletter\ShowNewsletterDetailRequest $request)
    {
        return view('newsletters.newsletter-detail', ['newsletter'=>$this->newsletters->findById($request->route()->parameter('newsletter_id'))]);
    }

    public function addNewsletter(Requests\Newsletter\AddNewsletterRequest $request)
    {
        try{
            $newsletter_images = [];
            $newsletterId = $this->newsletters->store([
                'name' => $request->input('name'),
                'detail' => $request->input('detail'),
            ])->id;
            if($request->file('images') != null) {
                foreach ($request->file('images') as $file) {
                    $public_path = '/images/newsletters/' . $newsletterId;
                    $destinationPath = public_path($public_path);
                    $filename = $file->getClientOriginalName();
                    $file->move($destinationPath, $filename);
                    $newsletter_images[] = [
                        'newsletter_id' => $newsletterId,
                        'path' => $public_path . '/' . $filename
                    ];
                }
                $this->newsletterImages->insertMultiple($newsletter_images);
            }
            return redirect()->back()->with('success','Newsletter Added Successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }

    public function showEditNewsletterForm(Requests\Newsletter\ShowEditNewsletterFormRequest $request)
    {
        return view('newsletters.edit-newsletter',['newsletter' => $this->newsletters->findById($request->route()->parameter('newsletter_id'))]);
    }

    public function updateNewsletter(Requests\Newsletter\UpdateNewsletterRequest $request)
    {
        try{
            $newsletter_images = [];
            $this->newsletters->updateWhere(['id' => $request->route()->parameter('newsletter_id')], [
                'name' => $request->input('name'),
                'detail' => $request->input('detail')
            ]);

            if($request->file('images') != null) {
                foreach ($request->file('images') as $file) {
                    $public_path = '/images/newsletters/'.$request->route()->parameter('newsletter_id');
                    $destinationPath = public_path($public_path);
                    $filename = $file->getClientOriginalName();
                    $file->move($destinationPath, $filename);
                    $newsletter_images[] = [
                        'newsletter_id' => $request->route()->parameter('newsletter_id'),
                        'path' => $public_path . '/'.$filename
                    ];
                }
                $this->newsletterImages->insertMultiple($newsletter_images);
            }

            return redirect()->back()->with('success','Newsletter Updated Successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }

//    public function deleteImage(\Illuminate\Http\Request $request)
//    {
//        $imagePath = $request->input('path');
//
//        //File::delete($imagePath);
//        //dd($imagePath);
//       // unlink($imagePath);
//        $id = $request->input('id');
//        if($this->newsletters->updateWhere(['id'=>$id],['image'=>'']))
//        {
//
//            return Response::json(array(
//                'status' => 'success',
//
//
//            ), 200);
//        }
//        else{
//            return Response::json(array(
//                'status' => 'failure',
//
//
//            ), 200);
//
//        }
//    }


    public function deleteImageById(\Illuminate\Http\Request $request)
    {

//        $id = $request->route()->parameter('image_id');
//        $image_path = findById($id);
//        unlink(public_path('file/to/delete'));
        return ($this->newsletterImages->deleteById($request->route()->parameter('image_id')))? Response::json(array('status' => 'success'), 200): Response::json(array('status' => 'success'), 200);
    }

    public function delete(Requests\Newsletter\DeleteNewsletterRequest $request)
    {
        try{
            $this->newsletters->deleteById($request->route()->parameter('newsletter_id'));
            return redirect()->back()->with('success','Newsletter deleted successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }
}
