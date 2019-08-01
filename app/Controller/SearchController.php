<?php


namespace App\Controller;

use App\Helper\FormHelper;
use App\Block\Posts\SearchResults;
use App\Model\PostModel;
use Core\Controller;

class SearchController extends Controller
{
    public function index()
    {
        $form = new FormHelper(url('search/search'), 'get', 'search-form');
        $form->addInput([
            'name'=>'search',
            'id'=>'search',
            'type'=>'text',
            'placeholder'=>'PVZ: title',

        ])->tag('button','Search');
        $this->view->form = $form->get();
        $form->wrapElement('page-wrapper','');
        $this->view->render('posts/searchresults');

    }
    public function search()
    {
        $keyword = $_GET['keyword'];
        $results = PostModel::getSearchResults($keyword);
        //echo json_encode($results);
        $block = new SearchResults();
        echo $block->getResultsBlock($results);
    }

}