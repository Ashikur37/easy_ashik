import 'package:flutter/foundation.dart';

class CategoryProvider extends ChangeNotifier {
  List _categories = [];
  bool isLoaded = false;
  String activeCategory = "";
  List _products = [];
  List _subcategories = [];
  bool isLoadingProduct = false;
  bool loadingMore = false;
  String nextPageURL = "";

  List get getCategories {
    return _categories;
  }

  List get getSubCategories {
    return _subcategories;
  }

  List get getProducts {
    return _products;
  }

  void setCategories(list) {
    _categories = list;
    notifyListeners();
  }

  void setSubCategories(list) {
    _subcategories = list;
    notifyListeners();
  }

  void setProducts(list) {
    _products = list;
    notifyListeners();
  }

  void mergeProducts(list) {
    _products.addAll(list);
    notifyListeners();
  }
}
