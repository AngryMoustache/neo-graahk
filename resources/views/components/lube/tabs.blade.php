<div class="tab-container-tabs">
    @foreach (config('lube.resources', []) as $resource)
        <a
            href="{{ route("lube.$resource.index") }}"
            @if (request()->is("admin/$resource*"))
                class="active"
            @endif
        >
            {{ ucfirst($resource) }}
        </a>
    @endforeach
</div>
