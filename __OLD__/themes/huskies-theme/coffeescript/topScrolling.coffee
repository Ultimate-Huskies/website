$topLink = ""

scrolling = (target) ->    
  if(jQuery.browser.opera) then animationTarget = 'html'
  else animationTarget = 'html,body'
  jQuery(animationTarget).animate { scrollTop: jQuery(target).offset().top }, 800

setTopLink = ->
  $topLink = jQuery("#top_navigator")
  #set the top link
  addTopLink
    min: 200
    fadeSpeed: 500
    
  #add smoothscroll to top link
  $topLink.on 'click', (e) ->
    e.preventDefault();
    scrolling('html');

addTopLink = (settings) ->
  #set default, if nothing is given
  settings = jQuery.extend {
    min: 1
    fadeSpeed: 200
  }, settings

  $topLink.each ->
    #listen for scroll
    el = jQuery(this)
    el.hide() #in case the user forgot
    jQuery(window).scroll ->
      if(jQuery(window).scrollTop() >= settings.min) then el.fadeIn settings.fadeSpeed
      else el.fadeOut settings.fadeSpeed