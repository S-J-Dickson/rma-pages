<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRMARequest;
use App\Http\Resources\RMAInListResource;
use App\Http\Resources\RMAResource;
use App\Models\RMA\RMA;
use App\Models\RMA\Type\BaseIdentifiableEnum;
use App\Models\RMA\Type\RMA_TYPE;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class RMAController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        //todo get resources
        $resources = RMAInListResource::collection([])->toArray($request);

        return Inertia::render('RMA/RMAList', ['data' => $resources]);
    }

    /**
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('RMA/CreateRMA', [
            'types' => RMA_TYPE::getCollection()->map(fn(RMA_TYPE $type) => [
                //todo assign correct values for text and value
//                'text' => ,
//                'value' => ,
                'items' => $type->getAssociatedInstanceMembers()->map(fn(BaseIdentifiableEnum $member) => [
//                    'text' => ,
//                    'value' =>
                ])->toArray()
            ])->toArray()
        ]);
    }

    /**
     * @param CreateRMARequest $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(CreateRMARequest $request): RedirectResponse
    {
        //todo validate the identifier

        //todo create the RMA

        return redirect(route('rma.index'))->with('status', 'RMA Created Successfully');
    }

    /**
     * @param RMA $rma
     * @param Request $request
     * @return Response
     */
    public function show($rma, Request $request): Response
    {
        //todo select the correct page component
        return Inertia::render('', RMAResource::make($rma)->toArray($request));
    }
}
