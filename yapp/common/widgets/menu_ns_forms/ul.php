
<li <?php if ($item['id'] == $this->currentItem ) {echo ' class="active"';}?>><a href="<?= $item['url'] ?>"><?php if ($item['depth'] > 0 ) {echo str_repeat('-', $item['depth']);}?><?= $item['name'] ?><?php if (isset($item['childs'])) : ?>
        <?php endif; ?></a><?php if (isset($item['childs'])) : ?>

        <ul>
            <?= $this->getMenuHtml($item['childs']) ?>
        </ul>
    <?php endif; ?></li>
