X      S?    ?      ??r    ?}???? ?             < V S G 2 R 0 0 1 . 0 J 2     X      S?    ?     X??r    ?}????  ?             < V S G 2 R 0 0 1 . 0 J 2     P      S?    P?    ???r    j?}????                < i n d e x . j s     P      S?    P?     ??r    j?}????               < i n d e x . j s     P      S?    P?    P??r    j?}???? ?             < i n d e x . j s     X      T?    ?     ???r    j?}????                < V S G 0 K 0 0 1 . 0 T 4     X      U?    ?     ???r    _~????                < V S G 0 K 0 0 1 . 0 T 5     X      T?    ?     P??r    _~????               < V S G 0 K 0 0 1 . 0 T 4     X      U?    ?     ???r    _~????               < V S G 0 K 0 0 1 . 0 T 5     X      U?    ?      ??r    _~???? ?             < V S G 0 K 0 0 1 . 0 T 5     X      U?    ?     X??r    _~????  ?             < V S G 0 K 0 0 1 . 0 T 5     X      T?    ?     ???r    _~????               < V S G 0 K 0 0 1 . 0 T 4     X      T?    ?     ??r    _~???? ?             < V S G 0 K 0 0 1 . 0 T 4     X      T?    ?     `??r    _~????  ?             < V S G 0 K 0 0 1 . 0 T 4     P      T?    P?    ???r    Ki~????                < L I C E N S E       P      T?    P?    ??r    Ki~????               < L I C E N S E       P      T?    P?    X??r    @?~???? ?             < L I C E N S E       X      U?    P?    ???r    ????                < p a c k a g e . j s o n     X      U?    P?     ??r    ????               < p a c k a g e . j s o n     X      U?    P?    X??r    ???? ?             < p a c k a g e . j s o n     X      V?    ?     ???r    )????                < V S G 0 G 0 0 1 . 0 L T     X      W?    ?     ??r    )????                < V S G 0 G 0 0 1 . 0 L U     X      V?    ?     `??r    )????               < V S G 0 G 0 0 1 . 0 L T     X      W?    ?     ???r    )????               < V S G 0 G 0 0 1 . 0 L U     X      W?    ?     ??r    )???? ?             < V S G 0 G 0 0 1 . 0 L U     X      W?    ?     h??r    )????  ?             < V S G 0 G 0 0 1 . 0 L U     X      V?    ?     ???r    )????               < V S G 0 G 0 0 1 . 0 L T     X      V?    ?     ??r    )???? ?             < V S G 0 G 0 0 1 . 0 L T     X      V?    ?     p??r    )????  ?             < V S G 0 G 0 0 1 . 0 L T     P      V?    P?    ???r    ?v????                < R E A D M E . m d   P      V?    P?    ??r    ?v????               < R E A D M E . m d   P      V?    P?    h??r    ?v???? ?             < R E A D M E . m d   P      W?    ??    ???r    ??????               < c a m e l c a s e   P      W?    ??    ??r    ??????  ?            < c a m e l c a s e   P      X?    W?    X??r    ??????                < i n d e x . j s     P      X?    W?    ???r    ??????               < i n d e x . j s     P      X?    W?    ???r    ?????? ?             < i n d e x . j s     X      Y?    ?     H??r    ?9?????                < V S G 2 R 0 0 1 . 0 J 3     X      Z?    ?     ???r    ?9?????                < V S G 2 R 0 0 1 . 0 J 4     X      Y?    ?     ???r    ?9?????               < V S G 2 R 0 0 1 . 0 J 3     X      Z?    ?     P??r    ?9?????               < V S G 2 R 0 0 1 . 0 J 4     X      Z?    ?     ???r    ?9????? ?             < V S G 2 R 0 0 1 . 0 J 4     X      Z?    ?      ??r    ?9?????  ?             < V S G 2 R 0 0 1 . 0 J 4     X      Y?    ?     X??r    ?9?????               < V S G 2 R 0 0 1 . 0 J 3     X      Y?    ?     ???r    ?9????? ?             < V S G 2 R 0 0 1 . 0 J 3     X      Y?    ?     ??r    ?9?????  ?             < V S G 2 R 0 0 1 . 0 J 3     P      Y?    W?    `??r    ???????                < l i c e n s e       P      Y?    W?    ???r    ???????               < l i c e n s e       
            return result;
        };

        entity.hasClass = function (componentType) {
            // Just consider componentType.main.
            componentType = parseClassType(componentType);
            return !!storage[componentType.main];
        };

        /**
         * @return {Array.<string>} Like ['aa', 'bb'], but can not be ['aa.xx']
         */
        entity.getAllClassMainTypes = function () {
            var types = [];
            zrUtil.each(storage, function (obj, type) {
                types.push(type);
            });
            return types;
        };

        /**
         * If a main type is container and has sub types
         * @param  {string}  mainType
         * @return {boolean}
         */
        entity.hasSubTypes = function (componentType) {
            componentType = parseClassType(componentType);
            var obj = storage[componentType.main];
            return obj && obj[IS_CONTAINER];
        };

        entity.parseClassType = parseClassType;

        function makeContainer(componentType) {
            var container = storage[componentType.main];
            if (!container || !container[IS_CONTAINER]) {
                container = storage[componentType.main] = {};
                container[IS_CONTAINER] = true;
            }
            return container;
        }

        if (options.registerWhenExtend) {
            var originalExtend = entity.extend;
            if (originalExtend) {
                entity.extend = function (proto) {
                    var ExtendedClass = originalExtend.call(this, proto);
                    return entity.registerClass(ExtendedClass, proto.type);
                };
            }
        }

        return entity;
    };

    /**
     * @param {string|Array.<string>} properties
     */
    clazz.setReadOnly = function (obj, properties) {
        // FIXME It seems broken in IE8 simulation of IE11
        // if (!zrUtil.isArray(properties)) {
        //     properties = properties != null ? [properties] : [];
        // }
        // zrUtil.each(properties, function (prop) {
        //     var value = obj[prop];

        //     Object.defineProperty
        //         && Object.defineProperty(obj, prop, {
        //             value: value, writable: false
        //         });
        //     zrUtil.isArray(obj[prop])
        //         && Object.freeze
        //         && Object.freeze(obj[prop]);
        // });
    };

    return clazz;
});