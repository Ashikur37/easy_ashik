import 'dart:convert';

import 'package:commerce/utilities/const.dart';
import 'package:http/http.dart';

getHttp(uri) async {
  print(uri);
  try {
    var response = await get(Uri.parse(uri));
    return jsonDecode(response.body);
  } catch (e) {
    print(e);
  }
}
