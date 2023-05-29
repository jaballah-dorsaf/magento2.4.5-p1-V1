# !/bin/bash 


ACCESS_TOKEN="jkg4h6t8spk8nw8u6bcc5x3cuqs5ca2z" # horsprod
URL_STORE="https://test123.mytek.tn" # dev

#upload multiple refactor stock item

curl  -v \
      -X POST \
      -H "Authorization: Bearer ${ACCESS_TOKEN}" \
      -H "Content-Type: application/json" \
      -d @multi_refactor.json \
         "${URL_STORE}/rest/V1/stock_syncronize" # |jq .