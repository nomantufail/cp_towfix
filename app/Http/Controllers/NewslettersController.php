<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\NewslettersRepository;
use Illuminate\Support\Facades\Auth;

class NewslettersController extends ParentController
{
    private $newsletters = null;
    public function __construct(NewslettersRepository $newslettersRepository)
    {
        parent::__construct();
        $this->newsletters = $newslettersRepository;
    }

    public function showNewsletters(Requests\Newsletter\ViewNewslettersRequest $request)
    {
        $newsletters = $this->newsletters->all();
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
            $public_path = '/images/newsletters/';
            $filename = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path($public_path), $filename);
            $this->newsletters->store([
                'name' => $request->input('name'),
                'detail' => $request->input('detail'),
                'image' => $public_path.$filename
            ]);
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
            $public_path = '/images/newsletters/';
            $filename = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path($public_path), $filename);
            $this->newsletters->updateWhere(['id'=>$request->route()->parameter('newsletter_id')],[
                'name' => $request->input('name'),
                'detail' => $request->input('detail'),
                'image' => $public_path.$filename
            ]);
            return redirect()->back()->with('success','Newsletter Updated Successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
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
