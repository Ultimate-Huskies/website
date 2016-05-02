function gce_tooltips(target_items){
  jQuery(target_items).each(function(){
    $self = jQuery(this);

    //modify span output
    $span = $self.children('span')[0].outerHTML;
    $self.children('span').remove();
    $self.prepend('<div class="contentWrapper">' + $span + '</div>');

    $content = $self.children('.gce-event-info');
    title = $content.children('.gce-tooltip-title').text();
    $content.children('.gce-tooltip-title').remove();

    $self.popover({
      animation:  true,
      html:       true,
      placement:  "bottom",
      selector:   ' > div.contentWrapper',
      title:      title,
      content:    $content.html()
    });

    jQuery('.contentWrapper').on('click', function() {
      $click = jQuery(this);
      jQuery('.gce-has-events div.popover').each(function() {
        $current = jQuery(this).parent().children('.contentWrapper');
        if($click.get(0) !== $current.get(0)) $current.popover('hide');
      });

      setTimeout(function() {
        $click.parent().find('*[title]').tooltip({
          animation: true,
          html:      true,
          placement: 'bottom'
        });
      }, 100); //timout here to wait for the new content
    });
  });
}