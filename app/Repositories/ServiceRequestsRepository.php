<?php
/**
 * Created by PhpStorm.
 * user: nomantufail
 * Date: 10/10/2016
 * Time: 10:13 AM
 */

namespace App\Repositories;


use App\Models\ServiceRequest;

class ServiceRequestsRepository extends Repository
{
    public function __construct(ServiceRequest $model)
    {
        $this->setModel($model);
    }

    public function getCustomerRequests($customerId)
    {
        return $this->getModel()
            ->with('customer')
            ->with('franchise')
            ->with('suggestedUser')
            ->with('vehicle')
            ->with('document')->where('customer_id',$customerId)->get();
    }

    public function getFranchiseRequests($franchiseId)
    {
        return $this->getModel()
            ->with('customer')
            ->with('franchise')
            ->with('suggestedUser')
            ->with('vehicle')
            ->with('document')->where('franchise_id',$franchiseId)->get();
    }
}