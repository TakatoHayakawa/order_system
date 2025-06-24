<script>
window.onload = function() {

         
    <?php if( session()->has('error_msgs') != null){ ?>
        <?php $error_msgs = session()->get('error_msgs'); ?>
        <?php if( count($error_msgs) > 0){ ?>
            <?php foreach($error_msgs as $error_msg){ ?>
                alert("{{ $error_msg['text'] }}");
            <?php } ?>
        <?php } ?>


        <?php session()->forget('error_msgs'); ?>
    <?php } ?>
        
        
};
</script>