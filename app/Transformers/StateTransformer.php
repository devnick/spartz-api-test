<?php namespace Spartz\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Spartz\Transformers\CityTransformer;

class StateTransformer extends TransformerAbstract
{
	/**
	 * List of resources possible to include
	 *
	 * @var  array
	 */
	protected $availableIncludes = ['cities', 'nearby'];

	/**
	 * List of resources to automatically include
	 *
	 * @var  array
	 */
	protected $defaultIncludes = [];

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
            'created'  => $resource->created_at,
            'updated'  => $resource->updated_at
        ];
	}

    public function includeCities($resource, ParamBag $params = null)
    {
        return $this->collection( $resource->cities, new CityTransformer );
    }

    public function includeNearby($resource, ParamBag $params = null)
    {
        dd($params);
        return $this->collection( $resource->cities, new CityTransformer );
    }

}