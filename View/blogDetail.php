<?php
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $blog = new Blog();
        $result = $blog->selectSingle($id);

    }
?>
<div class="container">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8" style="font-size: 1.8rem;">
            <div class="text-center my-5" > 
                <h1 style="font-size: 3rem;"><?php echo $result['title'] ?></h1>
            </div>
            <?php
                echo $result['content'];
            ?>
        </div>
        <div class="col-lg-2"></div>

        
    </div>
</div>
