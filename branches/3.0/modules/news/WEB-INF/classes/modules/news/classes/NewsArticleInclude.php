<?php

class NewsArticleInclude extends NewsArticlePeer {

  function getMostViewed($options) {
    $newsArticlePeer = new NewsArticlePeer();
    $newsMostViewed = $newsArticlePeer->getMostViewed();
    return $newsMostViewed;
  }

  function getArticle($options) { 
    $newsArticlePeer = new NewsArticlePeer();
    $newsArticle = $newsArticlePeer->get($options["id"]);
    return $newsArticle;
  }

}