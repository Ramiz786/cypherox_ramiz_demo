<div class="modal fade" id="deleteModalProduct" tabindex="-1" role="dialog" aria-labelledby="deleteModalExample"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalExample">Are you Sure You wanted to Delete?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Delete" below if you want to delete Category!.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('product-delete-form').submit();">
                    Delete
                </a>
                <form id="product-delete-form" method="POST" action="{{ route('product.destroy') }}">

                    <input type="hidden" name="id" class="data_id">
                    @csrf
                    <!-- @method('DELETE') -->
                </form>
                
            </div>
        </div>
    </div>
</div>

