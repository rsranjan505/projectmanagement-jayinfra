<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public $page = [];

    public function pageVariables($page_name,$description=null)
    {
        $this->page['title'] = 'Jay Infra Projects | Building Construction | About us';
        $this->page['description'] = 'At Jay Infra Projects, we aim at delivering high quality goods and providing impeccable services. We are a technologically driven company and excel in providing customized/  tailor made solutions for our customers to  suit their specific requirements.';
        $this->page['keywords'] = 'About us, About us Jay Infra Projects, construction buildings , about us Jay Infra Projects info, Jay Infra Projects About us ';
        $this->page['og_url'] = 'http://jayinfraprojects.com/'.$page_name;
        $this->page['og_type'] = 'article';
        $this->page['author'] = 'JAYINFRAPROJECTS';
        $this->page['domain'] = 'http://jayinfraprojects.com/';
        $this->page['address'] = 'Allahabad Bank Colony, Khajpura, P.S- Shastri Nagar, Patna, Bihar-800023';
        $this->page['contact_number'] = '';
        return $this->page;
    }
}
