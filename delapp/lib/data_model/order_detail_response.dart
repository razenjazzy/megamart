// To parse this JSON data, do
//
//     final orderDetailResponse = orderDetailResponseFromJson(jsonString);
//https://app.quicktype.io/
import 'dart:convert';

OrderDetailResponse orderDetailResponseFromJson(String str) => OrderDetailResponse.fromJson(json.decode(str));

String orderDetailResponseToJson(OrderDetailResponse data) => json.encode(data.toJson());

class OrderDetailResponse {
  OrderDetailResponse({
    this.detailed_orders,
    this.success,
    this.status,
  });

  List<DetailedOrder>? detailed_orders;
  bool? success;
  int? status;

  factory OrderDetailResponse.fromJson(Map<String, dynamic> json) => OrderDetailResponse(
    detailed_orders: List<DetailedOrder>.from(json["data"].map((x) => DetailedOrder.fromJson(x))),
    success: json["success"],
    status: json["status"],
  );

  Map<String, dynamic> toJson() => {
    "data": List<dynamic>.from(detailed_orders!.map((x) => x.toJson())),
    "success": success,
    "status": status,
  };
}

class DetailedOrder {
  DetailedOrder({
    this.id,
    this.code,
    this.user_id,
    this.shipping_address,
    this.shipping_type,
    this.shipping_type_string,
    this.payment_type,
    this.payment_status,
    this.payment_status_string,
    this.delivery_status,
    this.delivery_status_string,
    this.grand_total,
    this.coupon_discount,
    this.shipping_cost,
    this.subtotal,
    this.tax,
    this.date,
    this.cancel_request,
    this.links,
  });

  int? id;
  String? code;
  int? user_id;
  ShippingAddress? shipping_address;
  String? shipping_type;
  String? shipping_type_string;
  String? payment_type;
  String? payment_status;
  String? payment_status_string;
  String? delivery_status;
  String? delivery_status_string;
  String? grand_total;
  String? coupon_discount;
  String? shipping_cost;
  String? subtotal;
  String? tax;
  String? date;
  bool? cancel_request;
  Links? links;

  factory DetailedOrder.fromJson(Map<String, dynamic> json) => DetailedOrder(
    id: json["id"],
    code: json["code"],
    user_id: json["user_id"],
    shipping_address: ShippingAddress.fromJson(json["shipping_address"]),
    shipping_type: json["shipping_type"],
    shipping_type_string: json["shipping_type_string"],
    payment_type: json["payment_type"],
    payment_status: json["payment_status"],
    payment_status_string: json["payment_status_string"],
    delivery_status: json["delivery_status"],
    delivery_status_string: json["delivery_status_string"],
    grand_total: json["grand_total"],
    coupon_discount: json["coupon_discount"],
    shipping_cost: json["shipping_cost"],
    subtotal: json["subtotal"],
    tax: json["tax"],
    date: json["date"],
    cancel_request: json["cancel_request"],
    links: Links.fromJson(json["links"]),
  );

  Map<String, dynamic> toJson() => {
    "id": id,
    "code": code,
    "user_id": user_id,
    "shipping_address": shipping_address!.toJson(),
    "shipping_type": shipping_type,
    "shipping_type_string": shipping_type_string,
    "payment_type": payment_type,
    "payment_status": payment_status,
    "payment_status_string": payment_status_string,
    "delivery_status": delivery_status,
    "delivery_status_string": delivery_status_string,
    "grand_total": grand_total,
    "coupon_discount": coupon_discount,
    "shipping_cost": shipping_cost,
    "subtotal": subtotal,
    "tax": tax,
    "date": date,
    "cancel_request": cancel_request,
    "links": links!.toJson(),
  };
}

class Links {
  Links({
    this.details,
  });

  String? details;

  factory Links.fromJson(Map<String, dynamic> json) => Links(
    details: json["details"],
  );

  Map<String, dynamic> toJson() => {
    "details": details,
  };
}

class ShippingAddress {
  ShippingAddress({
    this.name,
    this.email,
    this.address,
    this.country,
    this.city,
    this.postal_code,
    this.phone,
    this.checkout_type,
  });

  String? name;
  String? email;
  String? address;
  String? country;
  String? city;
  String? postal_code;
  String? phone;
  String? checkout_type;

  factory ShippingAddress.fromJson(Map<String, dynamic> json) => ShippingAddress(
    name: json["name"] == null ? null : json["name"],
    email: json["email"] == null ? null : json["email"],
    address: json["address"] == null ? null : json["address"],
    country: json["country"] == null ? null : json["country"],
    city: json["city"] == null ? null : json["city"],
    postal_code: json["postal_code"] == null ? null : json["postal_code"],
    phone: json["phone"] == null ? null : json["phone"],
    checkout_type: json["checkout_type"] == null ? null : json["checkout_type"],
  );

  Map<String, dynamic> toJson() => {
    "name": name == null ? null : name,
    "email": email == null ? null : email,
    "address": address == null ? null : address,
    "country": country == null ? null : country,
    "city": city == null ? null : city,
    "postal_code": postal_code == null ? null : postal_code,
    "phone": phone == null ? null : phone,
    "checkout_type": checkout_type == null ? null : checkout_type,
  };
}
