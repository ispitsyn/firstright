<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<section class="card-slider card-slider_ind">
    <div class="card-slider__box section">
        <h2 class="card-slider__header">Популярные товары</h2>
        <ul class="card-slider__list">
            <li class="card-slider__item">
                <div class="product-card">
                    <div class="product-card__box" itemscope="itemscope" itemtype="http://schema.org/Product">
                        <div class="product-card__view"><img class="product-card__img" itemprop="image" src="<?=SITE_TEMPLATE_PATH?>/images/products/iphone_7.jpg" alt="" role="presentation"/>
                        </div>
                        <div class="product-card__info">
                            <h3 class="product-card__name"><span itemprop="brand">Apple </span><span itemprop="name">iPhone 7 128Gb <br/>Black</span>
                            </h3>
                            <p class="product-card__description h-content" itemprop="description">Суппер товар
                            </p>
                            <div class="product-card__price-box" itemprop="offers" itemscope="itemscope" itemtype="http://schema.org/Offer">
                                <p class="product-card__price product-card__price_old b-price b-price_old"><span>49 990</span></p>
                                <p class="product-card__price b-price">
                                    <meta itemprop="priceCurrency" content="RUB"/>
                                    <span itemprop="price">41 990</span>
                                </p>
                            </div>
                            <div class="product-card__btn">
                                <div class="btn btn_product-card waves-effect"><span>Купить</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</section>
