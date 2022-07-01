<?php

namespace Modules\Api\Http\Controllers;

use App\Helpers\Helpers;
use App\Helpers\ResponseHelpers;
use App\Jobs\jobUpdateJson;
use App\Service\Api\ApiArticleService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Config\Definition\Exception\Exception;

class ArticleController extends Controller
{
    private $function;

    public function __construct(ApiArticleService $function)
    {
        $this->function = $function;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('api::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('api::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        Log::info("33333");
        try {
            if ($this->function->store($request)) {
                ResponseHelpers::showResponse([], 'json');
            } else {
                ResponseHelpers::serverErrorResponse([], 'json');
            }
        } catch (Exception $ex) {
            Log::info($ex->getMessage());
            ResponseHelpers::serverErrorResponse([], 'json', $ex->getMessage());
        }
    }

    public function storeCompletedAt(Request $request)
    {
        try {
            $data = $request->all("crawler_category_id", "type");
            if($data["type"] == "crawler") {
                jobUpdateJson::dispatch($data)->delay(now()->addSeconds(100));
                Log::info("true insert crawler");
            }else{
                jobUpdateJson::dispatch($data)->delay(now()->addSeconds(10));
                Log::info("true insert demo");
            }

            ResponseHelpers::showResponse([], 'json');
        } catch (Exception $ex) {
            Log::info("true insert storeCompletedAt");
            ResponseHelpers::serverErrorResponse([], 'json', $ex->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('api::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('api::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
