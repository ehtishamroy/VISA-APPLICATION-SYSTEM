<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                          => 'ID',
            'id_helper'                   => ' ',
            'name'                        => 'Name',
            'name_helper'                 => ' ',
            'email'                       => 'Email',
            'email_helper'                => ' ',
            'email_verified_at'           => 'Email verified at',
            'email_verified_at_helper'    => ' ',
            'password'                    => 'Password',
            'password_helper'             => ' ',
            'roles'                       => 'Roles',
            'roles_helper'                => ' ',
            'remember_token'              => 'Remember Token',
            'remember_token_helper'       => ' ',
            'created_at'                  => 'Created at',
            'created_at_helper'           => ' ',
            'updated_at'                  => 'Updated at',
            'updated_at_helper'           => ' ',
            'deleted_at'                  => 'Deleted at',
            'deleted_at_helper'           => ' ',
            'administrator_office'        => 'Administrator Office',
            'administrator_office_helper' => ' ',
            'balance'                     => 'Balance',
            'balance_helper'              => ' ',
        ],
    ],
    'transaction' => [
        'title'          => 'Transaction',
        'title_singular' => 'Transaction',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'transaction'             => 'Transaction ID',
            'transaction_helper'      => ' ',
            'transaction_type'        => 'Transaction Type',
            'transaction_type_helper' => ' ',
            'agent'                   => 'Agent',
            'agent_helper'            => ' ',
            'customer'                => 'Customer',
            'customer_helper'         => ' ',
            'amount'                  => 'Amount',
            'amount_helper'           => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'created_by'              => 'Created By',
            'created_by_helper'       => ' ',
        ],
    ],
    'balanceHistory' => [
        'title'          => 'Balance History',
        'title_singular' => 'Balance History',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'agent'             => 'Agent',
            'agent_helper'      => ' ',
            'added_by'          => 'Added By',
            'added_by_helper'   => ' ',
            'amount'            => 'Amount',
            'amount_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'candidate' => [
        'title' => 'Candidates',
        'title_singular' => 'Candidate',
        'fields' => [
            'random_id' => 'Random ID',
            'name' => 'Name',
            'father_name' => 'Father Name',
            'mother_name' => 'Mother Name',
            'passport_number' => 'Passport Number',
            'cnic_number' => 'CNIC Number',
            'age' => 'Age',
            'city' => 'City',
            'applied_country' => 'Applied Country',
            'applied_company' => 'Applied Company',
            'applied_position' => 'Applied Position',
            'test_status' => 'Test Status',
            'payment_status' => 'Payment Status',
            'cv_status' => 'CV Status',
            'visa_status' => 'Visa Status',
        ],
    ],
];
