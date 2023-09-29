<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Gallery</title>
</head>
<style>
    .box span{
        display: flex;
        width: 50vw;
    }
    .gal{
        width: 100%;   
    }
</style>
<body>
    <div class="box">
        <span style="--i:1;"><img src="photos/00_01verzosa_feat_contrib_MatthewGibson.0e5b354a.jpg" alt="err" class="gal"></span>
        <span style="--i:2;"><img src="photos/00_01verzosa_feat_contrib_MatthewGibson.0e5b354a.jpg" alt="err" class="gal"></span>
        <span style="--i:3;"><img src="photos/00_01verzosa_feat_contrib_MatthewGibson.0e5b354a.jpg" alt="err" class="gal"></span>
        <span style="--i:4;"><img src="photos/00_01verzosa_feat_contrib_MatthewGibson.0e5b354a.jpg" alt="err" class="gal"></span>
        <span style="--i:5;"><img src="photos/00_01verzosa_feat_contrib_MatthewGibson.0e5b354a.jpg" alt="err" class="gal"></span>
        <span style="--i:6;"><img src="photos/00_01verzosa_feat_contrib_MatthewGibson.0e5b354a.jpg" alt="err" class="gal"></span>
        <span style="--i:7;"><img src="photos/00_01verzosa_feat_contrib_MatthewGibson.0e5b354a.jpg" alt="err" class="gal"></span>
        <span style="--i:8;"><img src="photos/00_01verzosa_feat_contrib_MatthewGibson.0e5b354a.jpg" alt="err" class="gal"></span>
    </div>
    <script type="text/javascript">
        let box = document.querySelector('.box');
        window.onmousemove = function(e){
            let x = e.clientX/3;
            box.style.transform = "perspective(1000px) rotateY("+x+"deg) rotateX("+x*3+"deg)";
        }
    </script>
</body>
</html>