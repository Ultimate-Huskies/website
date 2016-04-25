<?php

if (!$context['page']['user']['logged_in']) {
  abort($context, __('Not logged In', 'huskies'));
}
