{{-- 投票成功通知 --}}

@if(Session::has('flashMessage'))
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script>
    $(window).on('load', function() {
        $('#modal_box').modal('show');
    });
</script>

<div class="modal fade" id="modal_box" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="label1">通知</h5>
            </div>
            <div class="modal-body h6">
                {{ session('flashMessage') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" id="main-button-color" data-bs-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
</div>
@endif
