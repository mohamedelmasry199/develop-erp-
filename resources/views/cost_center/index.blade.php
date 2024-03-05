{{-- cost_center.index.blade.php --}}
<style>/* CSS for differentiating between opened and closed folders */
  ul.tree {
      list-style-type: none;
      padding-left: 20px;
  }
  
  ul.tree li {
      position: relative;
  }
  
  ul.tree li:before {
      content: " ";
      position: absolute;
      top: 0;
      left: -10px;
      width: 10px;
      border-left: 1px solid #000; /* Change the border color as needed */
  }
  
  ul.tree li:before {
      content: " ";
      position: absolute;
      top: 0;
      left: -10px;
      width: 10px;
      border-left: 1px solid #000; /* Change the border color as needed */
  }
  
  ul.tree li:last-child:before {
      height: 15px;
      border-left: 1px solid transparent; /* Hide the border for the last item */
  }
  
  /* CSS for folder and file icons */
  .folder-icon::before {
      content: "\1F4C1"; /* Unicode for folder icon, you can replace it with your preferred icon */
      margin-right: 5px;
  }
  
  .file-icon::before {
      content: "\1F4C4"; /* Unicode for file icon, you can replace it with your preferred icon */
      margin-right: 5px;
  }
  ul.tree ul {
        display: none;
    }

    /* Add this style to show sub-centers when the parent is not hidden */
    ul.tree ul:not(.hidden) {
        display: block;
    }
    .toggle-button.closed i::before {
    content: "\f07b"; /* Font Awesome closed folder icon */
  }

  .toggle-button.opened i::before {
    content: "\f07c"; /* Font Awesome opened folder icon */
  }
</style>
@if(!isset($createMainCenterLinkDisplayed))
  <div>
    <a href="{{ route('costcenter.create') }}">Create Main Center</a>
  </div>
  @php
    $createMainCenterLinkDisplayed = true;
  @endphp
@endif

<ul class="tree">
  @foreach ($costCenters as $costCenter)
    <li class="closed toggle-button">
      {{ $costCenter->name }}
      @if($costCenter->cost_center_type=="main")
        <span class="folder-icon" onclick="toggleFolder(this)"><i></i></span>
        <a href="{{ route('costcenter.createSub', ['main_center_id' => $costCenter->id]) }}">Create Subcenter</a>
      @else
        <span class="file-icon"></span>
      @endif
      <a href="{{ route('costcenter.edit', ['id' => $costCenter->id]) }}">Edit</a>
      <form action="{{ route('costcenter.destroy', ['id' => $costCenter->id]) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
      </form>
      @if($costCenter->subCenters->isNotEmpty())
        @include('cost_center.index', ['costCenters' => $costCenter->subCenters])
      @endif
    </li>
  @endforeach
</ul>

<script>
  function toggleFolder(icon) {
    var listItem = icon.parentNode;
    var sublist = listItem.querySelector('ul.tree');

    if (sublist) {
      sublist.classList.toggle('hidden');
      listItem.classList.toggle('closed');
      listItem.classList.toggle('opened');
    }
  }
</script>
