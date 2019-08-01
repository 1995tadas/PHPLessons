<?php
namespace App\Block\Posts;
class SearchResults
{
    public function getResultsBlock($results)
    {
        $html = '';
        $html .='<div class="posts-wrapper">';
        foreach ($results as $post){
        $html .= $this->getPostBlock($post);
    }

        $html.='</div>';
        return $html;
    }
    public function getPostBlock($post)
    {
        $html= '';
        $html .= '<div class="posts-column">';
        $html .= '<img src="'.$post->image.'">';
        $html .= "<h2>$post->title</h2>";
        $html .= '<a href="'.url('post/show',$post->id).'">Read More ...</a>';
        $html .= '</div>';
        return $html;

    }
}
