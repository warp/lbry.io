<?php Response::setMetaDescription(__('roadmap.description')) ?>
<?php Response::addJsAsset('/js/roadmap.js') ?>
<?php NavActions::setNavUri('/learn') ?>
<?php echo View::render('nav/_header', ['isDark' => false]) ?>
<?php js_start() ?>
  lbry.roadmap('#project-roadmap');
<?php js_end() ?>
<main>
  <div class="hero hero-quote hero-img hero-img-short spacer1" title="Here Be Dragons" style="background-image: url(/img/here-be-dragons.jpg)">
    <div class="hero-content-wrapper">
      <div class="hero-content text-center">
        <h1 class="cover-title">{{roadmap.title}}</h1>
        <h2 class="cover-subtitle">Past successes and future plans for the journey into the land of dragons.</h2>
      </div>
    </div>
  </div>
  <div class="content content-light spacer2">
    <h4>Roadmap Notes</h4>
    <p>
      Our roadmap pulls change notes directly from our Git repo via <a href="https://github.com/lbryio/lbry" class="link-primary">GitHub</a>.
      Ongoing, Upcoming and Future items are pulled directly from our internal project management system (<a href="https://asana.com" class="link-primary">Asana</a>).
    </p>
    <p>
      This roadmap only outlines past and anticipated technical changes, it does not cover other initiatives. Development was fast and furious among a small group prior to 0.6, and release notes are sparse.
    </p>
  </div>
  <div style="max-width: 800px; margin: 0 auto">
    <div class="roadmap-container" id="project-roadmap">
      <div class="text-center"><a href="javascript:;" class="link-primary show-all-roadmap-groups">Show Earlier Releases</a></div>
      <?php foreach($items as $group => $groupItems): ?>
        <?php $lastItem = end($groupItems) ?>
        <?php $isOpen = !isset($lastItem['project']) || !isset($lastItem['version']) || $lastItem['version'] === $projectMaxVersions[$lastItem['project']] ?>
        <h2 class="roadmap-group-title" <?php echo !$isOpen ? 'style="display: none"' : '' ?>">
          <span class="roadmap-group-title-label">
            <?php echo $group ?> <?php echo isset($lastItem['version']) && $lastItem['version'] === $projectMaxVersions[$lastItem['project']] ? '(latest)' : '' ?>
          </span>
        </h2>
        <div class="roadmap-group <?php echo !$isOpen ? 'roadmap-group-closed' : '' ?>">
          <?php $lastItem = end($groupItems) ?>
          <?php $maxItems = isset($lastItem['version']) ? 1 : count($groupItems) ?>
          <?php $index = 0 ?>
          <?php if (count($groupItems) > $maxItems): ?>
            <div class="text-center spacer1"><a href="javascript:;" class="link-primary show-all-roadmap-group-items">Show All Items for <?php echo $group ?></a></div>
          <?php endif ?>
          <?php foreach($groupItems as $item): ?>
            <?php ++$index ?>
            <div class="roadmap-item" <?php echo $index <= count($groupItems) - $maxItems ? 'style="display: none"' : '' ?>>
              <?php if (isset($item['badge']) || isset($item['assignee'])): ?>
                <div>
                  <?php if (isset($item['assignee'])): ?>
                    <span class="roadmap-item-assignee"><?php echo $item['assignee'] ?></span>
                  <?php endif ?>
                  <?php if (isset($item['badge'])): ?>
                    <span class="badge"><?php echo $item['badge'] ?></span><br/>
                  <?php endif ?>

                </div>
              <?php endif ?>
              <h3 class="roadmap-item-title">
                <?php if (isset($item['url']) && $item['url']): ?>
                  <a href="<?php echo $item['url'] ?>" class="link-primary"><?php echo $item['name'] ?></a>
                <?php else: ?>
                  <?php echo $item['name'] ?>
                <?php endif ?>
              </h3>
              <div class="roadmap-item-date">
                <?php echo $item['date'] ? date('m-d-Y', strtotime($item['date'])) : '' ?>
              </div>
              <div class="roadmap-item-content">
                <?php echo $item['body'] ?: '<em class="no-results">No description</em>' ?>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      <?php endforeach ?>
    </div>
  </div>
  <?php echo View::render('nav/_learnFooter') ?>
</main>
<?php echo View::render('nav/_footer') ?>