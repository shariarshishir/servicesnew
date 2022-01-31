<div id="share-modal" class="modal">
    <div class="modal-content">
        <input type="text" name="share_text" id="share_text" readonly >
        <a href="javascript:void(0)" onclick="copyToClipboard();">copy</a>
    </div>
</div>

@push('js')
<script type="text/javascript">
    function copyToClipboard(){
        document.getElementById('share_text').select();
        document.execCommand('copy');
    }
</script>

@endpush
