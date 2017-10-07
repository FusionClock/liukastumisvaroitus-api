<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    /**
     * @return Collection
     */
    public function expand(): Collection
    {
        return new Collection();
    }

    /**
     * @return Collection
     */
    public function filter(): Collection
    {
        return $this->getFormattedProperty('filter');
    }

    /**
     * @return Collection
     */
    public function order(): Collection
    {
        return $this->getFormattedProperty('order');
    }

    /**
     * @param string $proprety
     *
     * @return Collection
     */
    private function getFormattedProperty(string $proprety): Collection
    {
        if (!$this->has($proprety)) {
            return new Collection();
        }

        $filters = explode(',', $this->get($proprety));

        return Collection::make($filters)->map(function (string $filter) {
            $parts = explode(':', $filter);

            return Collection::make($parts);
        })->filter(function (Collection $filter) {
            return $filter->isNotEmpty();
        });
    }
}
