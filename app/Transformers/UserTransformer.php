<?php namespace Spartz\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class UserTransformer extends TransformerAbstract
{
	/**
	 * List of resources possible to include
	 *
	 * @var  array
	 */
	protected $availableIncludes = [];

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
            'id' => (int) $resource->id,
            'first_name' => $resource->first_name,
            'last_name' => $resource->last_name,
            'created'  => $resource->created_at,
            'updated'  => $resource->updated_at
        ];
	}
}

?>
