DROP VIEW IF EXISTS query_reports_view;

CREATE VIEW query_reports_view AS
SELECT
    transactions.reference AS transactions_reference,
    transactions.purchase_amount AS transactions_purchase_amount,
    transactions.platform_amount AS transactions_platform_amount,
    transactions.truncated_pan AS transactions_truncated_pan,
    transactions.status AS transactions_status,
    transactions.ip AS transactions_ip,
    transactions.created_at AS transactions_created_at,
    currency.alphabetic_code AS currencies_alphabetic_code,
    merchant.name AS merchants_name,
    country.alpha_3_code AS countries_alpha_3_code,
    payers.name AS payers_name,
    payers.email AS payers_email,
    buyers.name AS buyers_name,
    buyers.email AS buyers_email,
    pm.name AS payment_methods_name,
    device.browser AS devices_browser,
    device.os AS devices_os,
    device.device_type AS devices_device_type
FROM transactions
         LEFT JOIN merchants merchant ON transactions.merchant_uuid = merchant.uuid
         LEFT JOIN countries country ON merchant.country_uuid = country.uuid
         LEFT JOIN currencies currency ON transactions.currency_uuid = currency.uuid
         LEFT JOIN payers ON transactions.payer_uuid = payers.uuid
         LEFT JOIN buyers ON transactions.buyer_uuid = buyers.uuid
         LEFT JOIN payment_methods pm ON transactions.payment_method_uuid = pm.uuid
         LEFT JOIN devices device ON transactions.device_uuid = device.uuid;
