<?php

use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

//use the opensourced component to handle attachements- https://github.com/CodeSleeve/stapler

class Attachement extends Eloquent implements StaplerableInterface{
        use EloquentTrait;
        protected $table = 'attachements';
        protected $guarded = ['id'];
        
    public function __construct(array $attributes = array()){
        
        $this->hasAttachedFile('image', [
            'url' => '/system/:attachment/:id_partition/:style/:filename',
            'styles' => [
                'thumbnail' => ['dimensions' => '100x100', 'auto-orient' => true, 'convert_options' => ['quality' => 100]],
                'micro'     => '50X50'
            ],
            
        ]);
        
        $this->hasAttachedFile('voucher', [
            'url' => '/system/:attachment/:id_partition/:style/:filename',
            
        ]);
        
        
        
        parent::__construct($attributes);
    }
    
    
}