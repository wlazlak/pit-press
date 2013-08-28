<?php

//! @file ListController.php
//! @brief This file contains the ListController class.
//! @details
//! @author Filippo F. Fadda


namespace PitPress\Controller;


use ElephantOnCouch\Couch;
use ElephantOnCouch\Opt\ViewQueryOpts;

use PitPress\Helper\Time;


//! @brief Ancestor controller for any controller displaying posts.
//! @nosubgrouping
abstract class ListController extends BaseController {


  //! @brief Gets a list of tags recently updated.
  protected function getRecentTags() {
    $opts = new ViewQueryOpts();
    $opts->doNotReduce()->setLimit(60);
    $classifications = $this->couch->queryView("classifications", "latest", NULL, $opts)['rows'];
    $keys = array_column($classifications, 'value');

    $opts->reset();
    $opts->doNotReduce();
    $tags = $this->couch->queryView("tags", "all", $keys, $opts)['rows'];

    $opts->reset();
    $opts->groupResults();
    $postsPerTag = $this->couch->queryView("classifications", "perTag", $keys, $opts)['rows'];

    $recentTags = [];
    for ($i = 0; $i < 60; $i++)
      $recentTags[] = [$tags[$i]['value'], $postsPerTag[$i]['value']];

    return $recentTags;
  }


  //! @brief Given a set of keys, retrieves entries.
  protected function getEntries($keys) {
    $opts = new ViewQueryOpts();

    // Posts.
    $opts->doNotReduce()->includeMissingKeys();
    $posts = $this->couch->queryView("posts", "all", $keys, $opts)['rows'];

    // Users.
    $opts->reset();
    $opts->doNotReduce()->includeMissingKeys();
    $keys = array_column(array_column($posts, 'value'), 'userId');
    $users = $this->couch->queryView("users", "allNames", $keys, $opts)['rows'];

    // Stars.
    $opts->reset();
    $opts->includeMissingKeys()->groupResults();
    $stars = $this->couch->queryView("stars", "perItem", $keys, $opts)['rows'];

    // Scores.
    $opts->reset();
    $opts->includeMissingKeys()->groupResults();
    $scores = $this->couch->queryView("votes", "perPost", $keys, $opts)['rows'];

    $entries = [];
    $postCount = count($posts);
    for ($i = 0; $i < $postCount - 1; $i++) {
      $entry = new \stdClass();
      $entry->id = $posts[$i]['id'];

      $properties = &$posts[$i]['value'];
      $entry->title = $properties['title'];
      $entry->excerpt = $properties['excerpt'];
      $entry->url = $properties['url'];
      $entry->publishingType = $properties['publishingType'];
      $entry->whenHasBeenPublished = Time::when($properties['publishingDate']);
      $entry->userId = $properties['userId'];

      if (isset($entry->userId))
        $entry->displayName = $users[$i]['value'];
      elseif (isset($properties['username']))
        $entry->displayName = $properties['username'];
      else
        $entry->displayName = "anonimo";

      $entry->hitsCount = $this->redis->hGet($entry->id, 'hits');
      $entry->starsCount = is_null($stars[$entry->id]['value']) ? 0 : $stars[$entry->id]['value'];
      $entry->score = is_null($scores[$entry->id]['value']) ? 0 : $scores[$entry->id]['value'];

      // Tags.
      $opts->reset();
      $opts->doNotReduce()->setKey($entry->id);
      $classifications = $this->couch->queryView("classifications", "perPost", NULL, $opts)['rows'];

      $keys = [];
      foreach ($classifications as $classification)
        $keys[] = $classification['value'];

      $opts->reset();
      $opts->doNotReduce();
      $entry->tags = &$this->couch->queryView("tags", "all", $keys, $opts)['rows'];

      $entries[] = $entry;
    }

    return $entries;
  }

} 