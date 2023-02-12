<?php

declare(strict_types=1);

namespace Saloon\Tests\Fixtures\Connectors;

use Saloon\Http\Connector;
use Saloon\Contracts\Request;
use Saloon\Contracts\Paginator;
use Saloon\Http\Paginators\MinimalPaginator;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Http\Paginators\PageRequestPaginator;
use Saloon\Contracts\HasPagination;

class PagePaginatorConnector extends Connector implements HasPagination
{
    use AcceptsJson;

    /**
     * Define the base url of the api.
     *
     * @return string
     */
    public function resolveBaseUrl(): string
    {
        return apiUrl();
    }

    /**
     * Create a paginator instance
     *
     * @param \Saloon\Contracts\Request $request
     * @param mixed ...$additionalArguments
     * @return \Saloon\Contracts\Paginator
     */
    public function paginate(Request $request, mixed ...$additionalArguments): Paginator
    {
        return new MinimalPaginator($this, $request, 5);

        return new PageRequestPaginator($this, $request, 5, ...$additionalArguments);
    }
}
