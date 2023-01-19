@formField('checkbox', [
    'name' => 'csp_enabled',
    'label' => 'Enabled',
])

@formField('input', [
    'type' => 'textarea',
    'rows' => 6,
    'name' => 'csp_block',
    'label' => 'Block',
    'note' => 'Use https://report-uri.com/home/generate to parse and build your CSP rules',
])

@formField('input', [
    'type' => 'textarea',
    'rows' => 6,
    'name' => 'csp_report_only',
    'label' => 'Report only',
    'note' => 'Use https://report-uri.com/home/generate to parse and build your CSP rules',
])
