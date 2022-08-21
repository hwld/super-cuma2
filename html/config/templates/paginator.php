<?php

return [
    'nextActive' => '<li class="page-item"><a class="page-link" rel="next" href="{{url}}">{{text}}</a></li>',
    'nextDisabled' => '<li class="page-item disabled"><a class="page-link" href="" onclick="return false;">{{text}}</a></li>',
    'prevActive' => '<li class="page-item"><a class="page-link" rel="prev" href="{{url}}">{{text}}</a></li>',
    'prevDisabled' => '<li class="page-item disabled"><a class="page-link" href="" onclick="return false;">{{text}}</a></li>',
    'counterRange' => '{{start}} - {{end}} of {{count}}',
    'counterPages' => '{{page}} of {{pages}}',
    'first' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'last' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'current' => '<li class="page-item active"><a class="page-link" href="">{{text}}</a></li>',
    'ellipsis' => '<li class="page-item ellipsis">&hellip;</li>',
    'sort' => '<a class="sort d-flex justify-content-between align-items-center" href="{{url}}">{{text}}<img src="/img/selector.svg" width="20px" height="20px"/></a></div>',
    'sortAsc' => '<a class=" d-flex justify-content-between align-items-center sort asc" href="{{url}}">{{text}}<img src="/img/chevron-up.svg" width="20px" height="20px"/></a>',
    'sortDesc' => '<a class="d-flex justify-content-between align-items-center sort desc" href="{{url}}">{{text}}<img src="/img/chevron-down.svg" width="20px" height="20px"/></a>',
    'sortAscLocked' => '<a class="asc locked" href="{{url}}">{{text}}</a>',
    'sortDescLocked' => '<a class="desc locked" href="{{url}}">{{text}}</a>',
];