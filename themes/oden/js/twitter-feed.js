(function(){
  var container = document.querySelector(".oden-tweets > div");
  if (!container) return;
  
  container.innerHTML += "<div class='oden-tweets-list'></div>";
  
  var twitterFetcherConfig = {
    "profile": {"screenName": "odenetwork"},
    "maxTweets": 3,
    "dataOnly": true,
    "customCallback": handleTweets
  };
  twitterFetcher.fetch(twitterFetcherConfig);
  
  function handleTweets(tweets) {
    var element = document.querySelector('.oden-tweets-list');
    var html = '<ul>';
    for (var i = 0, length = tweets.length; i < length ; i++) {
      var tweet = tweets[i];
      html += '<li>'
        + '<p class="tweet-content">' + tweet.tweet + '</p>'
        + (tweet.author ? '<div class="tweet-author">'+tweet.author+'</div>' : '')
      + '</li>';
    }
    html += '</ul>';
    element.innerHTML = html;
  }
})();
