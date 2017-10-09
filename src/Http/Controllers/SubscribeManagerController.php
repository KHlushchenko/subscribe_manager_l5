<?php namespace Vis\SubscribeManager;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class SubscribeManagerController extends Controller
{
    private $subscribeManager;

    public function __construct()
    {
        $this->subscribeManager = new SubscribeManager();
    }

    public function doSubscribe($change = false)
    {
        return response()->json([
            'status' => $this->subscribeManager->subscribeToEntity(Input::all(), $change)
        ]);
    }

/*    public function doUnsubscribe($email)
    {
        return response()->json([
            'status' => $this->subscribeManager->unSubscribe($email)
        ]);
    }*/
}