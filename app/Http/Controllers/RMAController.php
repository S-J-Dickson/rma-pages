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
        $resources = RMAInListResource::collection(RMA::all())->toArray($request);
        return Inertia::render('RMA/RMAList', ['data' => $resources]);
    }

    /**
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render('RMA/CreateRMA', [
            'types' => RMA_TYPE::getCollection()->map(fn(RMA_TYPE $type) => [
                'text' => $type->description,
                'value' => $type->value,
                'items' => $type->getAssociatedInstanceMembers()->map(fn(BaseIdentifiableEnum $member) => [
                    'text' =>  $member->description,
                    'value' => $member->value
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
        RMA::createFromRequest($request);
        return redirect(route('rma.index'))->with('status', 'RMA Created Successfully');
    }

    /**
     * @param RMA $rma
     * @param Request $request
     * @return Response
     */
    public function show(RMA $rma, Request $request): Response
    {
        return Inertia::render('RMA/ViewRMA', RMAResource::make($rma)->toArray($request));
    }
}
