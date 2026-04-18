<?php

namespace Microservices\Sample\Pharmacy;

class PharmacyService
{
    public function dispenseMedication($prescriptionId)
    {
        // Logic to dispense medication
        return ['status' => 'dispensed'];
    }

    public function getInventory()
    {
        // Logic to get pharmacy inventory
        return ['inventory' => []];
    }
}

?>