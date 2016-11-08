<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\ManualImagesRepository;
use App\Repositories\ManualsRepository;
use Illuminate\Support\Facades\Auth;
use Response;

class ManualsControllers extends ParentController
{
    private $manuals = null;
    private $manualImages = null;

    public function __construct(ManualsRepository $manuals , ManualImagesRepository $manualImages)
    {
        parent::__construct();
        $this->manuals = $manuals;
        $this->manualImages = $manualImages;
    }

    public function showManuals(Requests\Manual\ViewManualsRequest $request)
    {
        $manuals = $this->manuals->getWithDetails();

            return view('manuals.list-manuals', ['manuals'=>$manuals]);


    }
    public function showAddManualForm(Requests\Manual\ShowAddManualFormRequest $request)
    {
        return view('manuals.add-manual');
    }
    public function manualDetail(Requests\Manual\ShowManualDetailRequest $request)
    {
        return view('manuals.manual-detail', ['manual'=>$this->manuals->findFullById($request->route()->parameter('manual_id'))]);
    }
    public function addManual(Requests\Manual\AddManualRequest $request)
    {
        try{

            $manual_images = [];
            $manualId = $this->manuals->store($request->storableAttrs())->id;
            foreach($request->file('images') as $file)
            {
                $public_path = '/images/manuals/'.$manualId;
                $destinationPath = public_path($public_path);
                $filename = $file->getClientOriginalName();
                $file->move($destinationPath, $filename);
                $manual_images[]=[
                    'manual_id' => $manualId,
                    'image' => $public_path.'/'.$filename
                ];
            }
            $this->manualImages->insertMultiple($manual_images);
            return redirect()->back()->with('success','Manual Added Successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }
    public function editManualForm(Requests\Manual\ShowEditManualFormRequest $request, $manual_id)
    {
        try{
        $data = [
            'manual' => $this->manuals->findFullById($manual_id)
        ];
        return view('manuals.edit-manual', $data);
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }
    public function updateManual(Requests\Manual\UpdateManualRequest $request, $manual_id)
    {
        try{
            $manual_images = [];
            $this->manuals->updateWhere(['id' => $manual_id], $request->updateableAttrs());

            if($request->file('images') != null) {

                foreach ($request->file('images') as $file) {
                    $public_path = '/images/products/'.$manual_id;
                    $destinationPath = public_path($public_path);
                    $filename = $file->getClientOriginalName();
                    $file->move($destinationPath, $filename);
                    $manual_images[] = [
                        'manual_id' => $manual_id,
                        'image' => $public_path . '/'.$filename
                    ];
                }
                $this->manualImages->insertMultiple($manual_images);
            }

            return redirect()->back()->with('success','Manual Updated Successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }

    public function delete(Requests\Manual\DeleteManualRequest $request)
    {

        try{
        $this->manuals->deleteById($request->route()->parameter('manual_id'));
        return redirect()->back()->with('success','Manual deleted successfully');
        }catch (\Exception $e){
            return $this->handleInternalServerError($e->getMessage());
        }
    }
    public function deleteImageById(\Illuminate\Http\Request $request)
    {
        return ($this->manualImages->deleteById($request->route()->parameter('image_id')))? Response::json(array('status' => 'success'), 200): Response::json(array('status' => 'success'), 200);
    }


}
