
<h1>A CSS Treeview Control</h1>
<section>
    <div class="treeview">
        @foreach ($costCenters as $costCenter)
            <details>
                <summary id="item-{{ $costCenter->id }}">{{ $costCenter->name }}</summary>
                @if ($costCenter->subCenters->count() > 0)
                    @include('cost_center.subtree', ['subCenters' => $costCenter->subCenters])
                @endif
            </details>
        @endforeach
    </div>
    <div id="display"></div>
</section>
<!-- resources/views/cost_center/partials/subtree.blade.php -->

