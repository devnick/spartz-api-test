<?php namespace Spartz\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Spartz\Transformers\StateTransformer;
use Spartz\Transformers\CityTransformer;
use League\Fractal\ParamBag;

class CityTransformer extends TransformerAbstract
{
	/**
	 * List of resources possible to include
	 *
	 * @var  array
	 */
	protected $availableIncludes = ['nearby'];

	/**
	 * List of resources to automatically include
	 *
	 * @var  array
	 */
	protected $defaultIncludes = ['state'];

	/**
	 * Transform object into a generic array
	 *
	 * @var  object
	 */
	public function transform($resource)
	{
		return [
            'id'       => (int) $resource->id,
            'name'     => $resource->name,
            'status'   => $resource->status,
            'created'  => $resource->created_at,
            'updated'  => $resource->updated_at
        ];
	}

    public function includeState($resource, ParamBag $params = null)
    {
        return $this->item( $resource->state, new StateTransformer );
    }

    public function includeNearby($resource, ParamBag $params = null)
    {
        $limit  = isset($params->get('limit')[0]) ? $params->get('limit')[0] : 10;
        $offset = isset($params->get('limit')[0]) ? $params->get('limit')[1] : 0;

        $nearby = $resource->distance($params->get('radius')[0])->take($limit)->skip($offset)->get();

        return $this->collection($nearby, new CityTransformer);
    }
}