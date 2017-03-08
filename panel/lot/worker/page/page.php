<?php if (substr($__path, -2) === '/+' || strpos($__path, '/+/') !== false): ?>
<form id="form.m.editor" action="" method="post" enctype="multipart/form-data">
  <aside class="s">
    <?php if ($__source[0]): ?>
    <section class="s-source">
      <h3><?php echo $language->source; ?></h3>
      <ul>
        <li><?php echo HTML::a($__source[1]->title, $__source[0]->url); ?></li>
      </ul>
    </section>
    <?php endif; ?>
    <section class="s-kin">
      <h3><?php echo $language->{count($__datas[0]) === 1 ? 'kin' : 'kins'}; ?></h3>
      <ul>
        <?php foreach ($__datas[0] as $k => $v): ?>
        <li><?php echo HTML::a($__datas[1][$k]->key, $v->url); ?></li>
        <?php endforeach; ?>
        <li><?php echo HTML::a('&#x2795;', $__state->path . '/::s::/' . rtrim(explode('/+/', $__path . '/')[0], '/') . '/+', false, ['title' => $language->add]); ?></li>
      </ul>
    </section>
  </aside>
  <main class="m">
    <?php echo $__message; ?>
    <fieldset>
      <legend><?php echo $language->editor; ?></legend>
      <div class="f f-content expand p">
        <label for="f-content"><?php echo $language->content; ?></label>
        <div>
<?php echo Form::textarea('content', $__page[0]->content, $language->f_content, [
    'classes' => ['textarea', 'block', 'expand', 'code', 'editor'],
    'id' => 'f-content'
]); ?>
        </div>
      </div>
      <p class="f f-key">
        <label for="f-key"><?php echo $language->key; ?></label>
        <span>
<?php echo Form::text('key', $__page[0]->key, null, [
    'classes' => ['input'],
    'id' => 'f-key',
    'pattern' => '^[a-z\\d_]+$'
]); ?>
        </span>
      </p>
    </fieldset>
    <p class="f f-state expand">
      <label for="f-state"><?php echo $language->state; ?></label>
      <span>
<?php

$s = substr($__path, -2) === '/+';
foreach ([
    'data' => $language->{$s ? 'save' : 'update'},
    'trash' => $s ? false : $language->delete
] as $k => $v) {
    if (!$v) continue;
    echo ' ' . Form::submit('x', $k, $v, [
        'classes' => ['button', 'x-' . $k],
        'id' => 'f-state:' . $k
    ]);
}

?>
      </span>
    </p>
    <?php echo Form::token(); ?>
  </main>
</form>
<?php else: ?>
<form id="form.m.editor" action="" method="post" enctype="multipart/form-data">
  <aside class="s">
    <section class="s-author">
      <h3><?php echo $language->author; ?></h3>
      <p><?php echo Form::text('author', $__page[0]->author); ?></p>
    </section>
    <?php if ($__parent[0]): ?>
    <section class="s-parent">
      <h3><?php echo $language->parent; ?></h3>
      <ul>
        <li><?php echo HTML::a($__parent[1]->title, $__parent[0]->url); ?></li>
      </ul>
    </section>
    <?php endif; ?>
    <?php if ($__kins[0]): ?>
    <section class="s-kin">
      <h3><?php echo $language->{count($__kins[0]) === 1 ? 'kin' : 'kins'}; ?></h3>
      <ul>
        <?php foreach ($__kins[0] as $k => $v): ?>
        <li><?php echo HTML::a($__kins[1][$k]->title, $v->url); ?></li>
        <?php endforeach; ?>
        <?php if ($__is_kin_has_step): ?>
        <li><?php echo HTML::a('&#x2026;', $__state->path . '/::g::/' . Path::D($__path) . '/2', false, ['title' => $language->more]); ?></li>
        <?php endif; ?>
      </ul>
    </section>
    <?php endif; ?>
    <?php if ($__sgr === 'g' && Get::pages(LOT . DS . $__path, 'draft,page,archive')): ?>
    <section class="s-setting">
      <h3><?php echo $language->settings; ?></h3>
      <h4><?php echo $language->sort; ?></h4>
      <table class="table">
        <thead>
          <tr>
            <th><?php echo $language->order; ?></th>
            <th><?php echo $language->by; ?></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo Form::radio('sort[0]', $language->panel->sort[0], isset($__parent[0]->sort[0]) ? $__parent[0]->sort[0] : (isset($__page[0]->sort[0]) ? $__page[0]->sort[0] : null), ['classes' => ['input']]); ?></td>
            <td><?php echo Form::radio('sort[1]', $language->panel->sort[1], isset($__parent[0]->sort[1]) ? $__parent[0]->sort[1] : (isset($__page[0]->sort[1]) ? $__page[0]->sort[1] : null), ['classes' => ['input']]); ?></td>
          </tr>
        </tbody>
      </table>
      <h4><?php echo $language->chunk; ?></h4>
      <p><?php echo Form::number('chunk', $__page[0]->chunk, 7, ['classes' => ['input', 'block'], 'min' => 0, 'max' => 20]); ?></p>
      <h4><?php echo $language->options; ?></h4>
      <p><em><?php echo $language->none; ?></em></p>
    </section>
    <?php endif; ?>
  </aside>
  <main class="m">
    <?php echo $__message; ?>
    <fieldset>
      <legend><?php echo $language->editor; ?></legend>
      <p class="f f-title expand">
        <label for="f-title"><?php echo $language->title; ?></label>
        <span>
<?php echo Form::text('title', $__page[0]->title, $language->f_title, [
    'classes' => ['input', 'block'],
    'id' => 'f-title',
    'data' => ['slug-i' => 'title']
]); ?>
        </span>
      </p>
      <p class="f f-slug expand">
        <label for="f-slug"><?php echo $language->slug; ?></label>
        <span>
<?php echo Form::text('slug', $__page[0]->slug, To::slug($language->f_title), [
    'classes' => ['input', 'block'],
    'id' => 'f-slug',
    'data' => ['slug-o' => 'title'],
    'pattern' => '^[a-z\\d-]+$'
]); ?>
        </span>
      </p>
      <div class="f f-content expand p">
        <label for="f-content"><?php echo $language->content; ?></label>
        <div>
<?php echo Form::textarea('content', $__page[0]->content, $language->f_content, [
    'classes' => ['textarea', 'block', 'expand', 'code', 'editor'],
    'id' => 'f-content',
    'data' => ['type' => $__page[0]->type]
]); ?>
        </div>
      </div>
      <p class="f f-type">
        <label for="f-type"><?php echo $language->type; ?></label>
        <span>
<?php $__types = a(Config::get('panel.f.page.types')); ?>
<?php asort($__types); ?>
<?php echo Form::select('type', $__types, $__page[0]->type, [
    'classes' => ['select'],
    'id' => 'f-type'
]); ?>
        </span>
      </p>
      <div class="f f-description p">
        <label for="f-description"><?php echo $language->description; ?></label>
        <div>
<?php echo Form::textarea('description', $__page[0]->description, $language->f_description($language->page), [
    'classes' => ['textarea', 'block'],
    'id' => 'f-description'
]); ?>
        </div>
      </div>
      <p class="f f-link">
        <label for="f-link"><?php echo $language->link; ?></label>
        <span>
<?php echo Form::url('link', $__page[0]->link, $url->protocol, [
    'classes' => ['input', 'block'],
    'id' => 'f-link'
]); ?>
        </span>
      </p>
      <?php if ($__sgr !== 's'): ?>
      <p class="f f-time">
        <label for="f-time"><?php echo $language->time; ?></label>
        <span>
<?php echo Form::text('time', (new Date($__page[0]->time))->format('Y/m/d H:i:s'), date('Y/m/d H:i:s'), [
    'classes' => ['input', 'date'],
    'id' => 'f-time'
]); ?>
        </span>
      </p>
      <?php endif; ?>
    </fieldset>
    <p class="f f-state expand">
      <label for="f-state"><?php echo $language->state; ?></label>
      <span>
<?php

$__x = $__page[0]->state;

if ($__sgr !== 's') {
    echo Form::submit('x', $__x, $language->update, [
        'classes' => ['button', 'x-' . $__x],
        'id' => 'f-state:' . $__x,
        'title' => $__x
    ]);
}

foreach ([
    'page' => $language->publish,
    'draft' => $language->save,
    'archive' => $language->archive,
    'trash' => $language->delete
] as $k => $v) {
    if ($__x === $k) continue;
    echo ' ' . Form::submit('x', $k, $v, [
        'classes' => ['button', 'x-' . $k],
        'id' => 'f-state:' . $k
    ]);
}

?>
      </span>
    </p>
    <?php echo Form::token(); ?>
  </main>
  <aside class="s">
    <?php if ($__sgr === 'g'): ?>
    <section class="s-data">
      <h3><?php echo $language->{count($__datas[0]) === 1 ? 'data' : 'datas'}; ?></h3>
      <ul>
        <?php foreach ($__datas[0] as $k => $v): ?>
        <li><?php echo HTML::a($__datas[1][$k]->key, $v->url); ?></li>
        <?php endforeach; ?>
        <li><?php echo HTML::a('&#x2795;', $__state->path . '/::s::/' . rtrim(explode('/+/', $__path . '/')[0], '/') . '/+', false, ['title' => $language->add]); ?></li>
      </ul>
    </section>
    <?php endif; ?>
    <?php if (count($__chops) > 1): ?>
    <?php if ($__childs[0]): ?>
    <section class="s-child">
      <h3><?php echo $language->{count($__childs[0]) === 1 ? 'child' : 'childs'}; ?></h3>
      <ul>
        <?php foreach ($__childs[0] as $k => $v): ?>
        <?php

        $g = $v->path;
        $gg = Path::X($g);
        $ggg = Path::D($g);
        $gggg = Path::N($g) === Path::N($ggg) && file_exists($ggg . '.' . $gg);

        if ($gggg) continue; // skip the placeholder page

        ?>
        <li><?php echo HTML::a($__childs[1][$k]->title, $v->url); ?></li>
        <?php endforeach; ?>
        <li><?php echo HTML::a('&#x2795;', $__state->path . '/::s::/' . $__path, false, ['title' => $language->add]); ?><?php echo $__is_child_has_step ? ' ' . HTML::a('&#x2026;', $__state->path . '/::g::/' . $__path . '/2', false, ['title' => $language->more]) : ""; ?></li>
      </ul>
    </section>
    <?php endif; ?>
    <?php endif; ?>
  </aside>
</form>
<?php endif; ?>