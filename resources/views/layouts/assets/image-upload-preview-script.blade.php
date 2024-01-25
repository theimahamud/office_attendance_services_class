<script>
    $(document).ready(()=>{
        $('.image-upload-input').change(function(){
            const file = this.files[0];
            //console.log(file);
            if (file){
                let reader = new FileReader();
                reader.onload = function(event){
                    console.log(event.target.result);
                    $('.image-preview').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
