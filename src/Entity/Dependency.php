<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource(itemOperations: ['get'],
    collectionOperations: ['get'],
    paginationEnabled: false
    )]
class Dependency {
    
    #[ApiProperty(
        identifier: true
    )]
    private string $uuid;

    #[ApiProperty(
        description: 'Nom de la dependance'
    )]
    private string $name;

    #[ApiProperty(
        description: 'Version de la dependance',
        openapiContext: [
            'example' => "1.0.*"
        ]
    )]
    private string $version;

    public function __construct(string $uuid, string $name, string $version)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->version = $version;
    }


    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of version
     */ 
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Get the value of uuid
     */ 
    public function getUuid()
    {
        return $this->uuid;
    }
}