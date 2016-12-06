<?php

return [
    
    // API Result
    'RESULT_INITIAL' => 0,
    'RESULT_SUCCESS' => 1,
    'RESULT_ERROR'   => 2,
    
    // Call Status
    'CALL_DIALED'  => 0,
    'CALL_SUCCESS' => 1,
    'CALL_MISSED'  => 2,
    
    // DB Statuses
    'STATUS_PENDING'   => 0,
    'STATUS_ACTIVE'    => 1,
    'STATUS_SUSPENDED' => 2,
    'STATUS_INACTIVE'  => 3,
    
    'STATUS' => array(
                    array(
                        'value' => 0,
                        'label' => "Pending"
                    ),
                    array(
                        'value' => 1,
                        'label' => "Active"
                    ),
                    array(
                        'value' => 2,
                        'label' => "Suspended"
                    ),
                    array(
                        'value' => 3,
                        'label' => "Inactive"
                    )
                ),
    
    'PAGE_LIMIT' => 10,
    
    // ARCHER CONFIG
    "ARCHER_HOME_URL" => "http://10.251.14.197:8093",
    "ARCHER_INSTANCE" => "IRB",
    "ARCHER_USERNAME" => "IRB",
    "ARCHER_PASSWORD" => "pldtglobal",
    "ARCHER_DEALERID" => "319",
    
    "SERVER" => "development"
    
];