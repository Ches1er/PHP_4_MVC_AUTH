<h1><?=$hh?></h1>
<a href="/main/secure">SECURE</a>
<?php if (isset($error)):?>
<div class="error"><?=$error?></div>
<?php endif;?>

<ul>
    <li><a href="/main/register">Регистрация</a></li>
    <?php if ($hh!="non activ user"):?>
    <li><a href="/main/logout">Выход</a></li>
    <?php else:?>
    <li><a href="/main/login">Вход</a></li>
    <?php endif;?>
</ul>

<table>
    <tr>
        <th>name</th>
        <th>year</th>
        <th>author</th>
    </tr>
<?php
foreach ($films as $film):?>
    <tr>
        <td><?=$film->name?></td>
        <td><?=$film->year?></td>
        <td><?=$film->user()->login?></td>
    </tr>
<?php endforeach;?>
</table>
<h2>-!!!!!!!!!!!!!!!!!!-</h2>
<h1><?=$hh?></h1>
<table>
    <tr>
        <th>name</th>
        <th>year</th>
        <th>author</th>
    </tr>
    <?php foreach ($films2 as $film):?>
        <tr>
            <td><?=$film->name?></td>
            <td><?=$film->year?></td>
            <td><?=$film->user()->login?></td>
        </tr>
    <?php endforeach;?>
</table>