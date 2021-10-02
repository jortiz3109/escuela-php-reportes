DROP VIEW IF EXISTS query_reports_view;

CREATE VIEW query_reports_view AS
SELECT
    transactions.id AS transaction_id,
    transactions.reference AS transaction_reference,
    transactions.purchase_amount AS transaction_purchase_amount,
    transactions.platform_amount AS transaction_platform_amount,
    transactions.truncated_pan AS transaction_truncated_pan,
    transactions.status AS transaction_status,
    transactions.ip AS transaction_ip,
    currency.alphabetic_code AS transaction_currency,
    transactions.created_at AS transaction_created_at,
    merchant.name AS merchant_name,
    country.alpha_3_code AS merchant_country_name,
    payers.name AS payer_name,
    payers.email AS payer_email,
    buyers.name AS buyer_name,
    buyers.email AS buyer_email,
    pm.name AS payment_method_name,
    device.browser AS device_browser,
    device.os AS device_os,
    device.device_type AS device_type
FROM transactions
         LEFT JOIN merchants merchant ON transactions.merchant_id = merchant.id
         LEFT JOIN countries country ON merchant.country_id = country.id
         LEFT JOIN currencies currency ON transactions.currency_id = currency.id
         LEFT JOIN payers ON transactions.payer_id = payers.id
         LEFT JOIN buyers ON transactions.buyer_id = buyers.id
         LEFT JOIN payment_methods pm ON transactions.payment_method_id = pm.id
         LEFT JOIN devices device ON transactions.device_id = device.id;
