(function(){
  var container = document.querySelector(".oden-tweets > div");
  if (!container) return;
  
  container.innerHTML += "<div class='oden-tweets-list'></div>";
  
  var maxTweets = 3;
  if (document.querySelector(".oden-tweets").classList.contains("oden-tweets__sidebar")) {
    maxTweets = 1;
  }
  
  var twitterFetcherConfig = {
    "profile": {"screenName": "odenetwork"},
    "maxTweets": maxTweets,
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
