
<li <?php if ($item['id'] == $this->currentItem ) {echo ' class="active text-danger"';}?>><a href="/menu/view?id=<?= $item['id'] ?>"<?php if ($item['id'] == $this->currentItem ) {echo ' class="text-danger"';}?>><?php if ($item['depth'] > 0 ) {echo str_repeat('-', $item['depth']);}?><?php if ($item['icon']) {echo $item['icon'];}?><?= $item['name'].' <sup>'.$item['url'].'</sup>' ?><?php if (isset($item['childs'])) : ?>
        <?php endif; ?></a><?php if (isset($item['childs'])) : ?>

        <ul>
            <?= $this->getMenuHtml($item['childs']) ?>
        </ul>
    <?php endif; ?></li>
