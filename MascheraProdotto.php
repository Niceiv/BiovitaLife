<style>
    .product-grid {
        font-family: 'Poppins', sans-serif;
        text-align: center;
    }

    .product-grid .product-image {
        overflow: hidden;
        position: relative;
        z-index: 1;
    }

    .product-grid .product-image a.image {
        display: block;
    }

    .product-grid .product-image img {
        width: 100%;
        height: auto;
    }

    .product-grid .product-discount-label {
        color: #fff;
        background: #A5BA8D;
        font-size: 13px;
        font-weight: 200;
        line-height: 25px;
        padding: 0 20px;
        position: absolute;
        top: 10px;
        left: 0;
    }

    .product-grid .product-links {
        padding: 0;
        margin: 0;
        list-style: none;
        position: absolute;
        top: 10px;
        right: -50px;
        transition: all .5s ease 0s;
    }

    .product-grid:hover .product-links {
        right: 10px;
    }

    .product-grid .product-links li a {
        color: #333;
        background: transparent;
        font-size: 17px;
        line-height: 38px;
        width: 38px;
        height: 38px;
        border: 1px solid #333;
        border-bottom: none;
        display: block;
        transition: all 0.3s;
    }

    .product-grid .product-links li:last-child a {
        border-bottom: 1px solid #333;
    }

    .product-grid .product-links li a:hover {
        color: #fff;
        background: #333;
    }

    .product-grid .add-to-cart {
        background: #A5BA8D;
        color: #fff;
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 2px;
        width: 100%;
        padding: 10px 26px;
        position: absolute;
        left: 0;
        bottom: -60px;
        transition: all 0.3s ease 0s;
    }

    .product-grid:hover .add-to-cart {
        bottom: 0;
    }

    .product-grid .add-to-cart:hover {
        text-shadow: 4px 4px rgba(0, 0, 0, 0.2);
    }

    .product-grid .product-content {
        background: #fff;
        padding: 15px;
        box-shadow: 0 0 0 5px rgba(0, 0, 0, 0.1) inset;
    }

    .product-grid .title {
        font-size: 16px;
        font-weight: 600;
        text-transform: capitalize;
        margin: 0 0 7px;
    }

    .product-grid .title a {
        color: #777;
        transition: all 0.3s ease 0s;
    }

    .product-grid .title a:hover {
        color: #a5ba8d;
    }

    .product-grid .price {
        color: #0d0d0d;
        font-size: 14px;
        font-weight: 600;
    }

    .product-grid .price span {
        color: #888;
        font-size: 13px;
        font-weight: 600;
        text-decoration: line-through;
    }

    @media screen and (max-width: 990px) {
        .product-grid {
            margin-bottom: 30px;
        }
    }
</style>

<?php



function MostraProdotto($idutente, $idprodotto, $file_img, $preferito, $nome_prod, $costo_prod, $qta)
{

?>
    <div class="product-grid">
        <div class="product-image">
            <a href="#" class="image">

                <img src="<?= $file_img ?>">

            </a>
            <span class="product-discount-label">
                <?= $qta ?>
            </span>
            <ul class="product-links" onclick="AggiungiAPreferiti(<?= $idutente ?>,<?= $preferito ?>,<?= $idprodotto ?>)">
                <!-- <li><a href="#"><i class="fa fa-search"></i></a></li>
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-random"></i></a></li> -->
                <?php
                if ($preferito == 0) {
                    //cuore bianco <i class="fa-light fa-heart"></i>
                    echo "<li><a href='#'><i class='fa fa-heart-o'  style='font-size:24px'></i></a></li>";
                } else {
                    //cuore rosso
                    echo "<li><a href='#'><i class='fa fa-heart'  style='font-size:24px;color:red;'></i></a></li>";
                }

                ?>
            </ul>
            <input type="button" class="add-to-cart" value="Aggiungi al Carrello" id="btnCar" onclick="AggiungiACarrello(<?= $idutente ?>,<?= $idprodotto ?>, <?= $qta ?>);">
        </div>

        <div class="product-content">
            <h3 class="title"><a href="#">
                    <?= $nome_prod ?>
                </a></h3>
            <div class="price">

                <?= $costo_prod ?>
            </div>
        </div>
    </div>

<?php
}
?>