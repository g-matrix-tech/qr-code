import sys
import json
from dbr import *

image = sys.argv[1]

#Config for Dev
license_key = 't0068fQAAAJfE0UexTj0YjVnRC+uhyci/TUSB3p4XsKc6BaxcuG1GhkooNx1T7A3cbb5s4AWFO7gddweiEDLr4f08r2ToifY='
reader = BarcodeReader()
error = reader.init_license(license_key)

# Config for Prod
#reader = BarcodeReader()
#ltspar = reader.init_lts_connection_parameters()
#ltspar.handshake_code = "100***901-100***124"
#error = reader.init_license_from_lts(ltspar)


# If initialization went wrong return error message
if error[0] != EnumErrorCode.DBR_OK:
    print(
        json.dumps(
            {
                "code": "error",
                "result": {
                    "code": error[0],
                    "message": error[1],
                }
            }
        )
    )
    sys.exit()


try:
    text_results = reader.decode_file(image)

    result = []
    if text_results != None:

        priResult = {
            "code": "ok",
            "result": []
        }

        for text_result in text_results:
            priResult["result"].append({
                "barcodeFormat": text_result.barcode_format_string,
                "barcodeText": text_result.barcode_text
            })

        result = priResult

    else:
        result = {
            "code": "error",
            "result": {
                "message": "Original system could not scan Qr-code."
            }
        }

    print(json.dumps(result))

except BarcodeReaderError as bre:
    # If scanning is not successful
    print(
        json.dumps(
            {
                "code": "error",
                "result": {
                    "message": bre.error_info + " " +  image
                }
            }
        )
    )
