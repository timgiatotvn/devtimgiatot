<?php

namespace App\Feed;

use App\Model\Post;
use Carbon\Carbon;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class NewsItem extends Post implements Feedable
{
    public function toFeedItem()
    {
        // dd($this->admin->name);
        /** This is a standard FeedItem which must return collection and I am just passing the data that is required for it. Feel free to changes as per you convince */
	    return FeedItem::create([
            'id' => route('client.post.show', ['slug' => $this->slug]),
            'title' =>  $this->title,
            'summary' => $this->description == NULL ? '' : $this->description,
            'content' => $this->content,
            'updated' => $this->updated_at,
            'link' => route('client.post.show', ['slug' => $this->slug]),
            'author' => !empty($this->admin) ? $this->admin->name : '',
        ]);
    }

    /** This function is responsible to get all your NewsItem feeds. This NewsItems gets the data from the previous created feeds. */
    public static function getFeedItems()
    {
        /** I am getting only the published details */
        return NewsItem::orderBy('id', 'DESC')
                        ->with('admin')
                        ->where('status', 1)
                        ->get();
    }
}