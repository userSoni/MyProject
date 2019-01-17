﻿using System;
using System.Collections.Generic;
using System.Linq;
using System.Linq.Expressions;
using System.Reflection;
using System.Text;
using System.Threading.Tasks;

namespace WpfLoginChat.Core
{
    //A helper for Expression
    public static class ExpressionHelpers
    {
        //Compiles an expression and gets the functions return value
        //'T' The type of return of value
        //'lamba' The expression to compile
        public static T GetPropertyValue<T>(this Expression<Func<T>> lamba)
        {
            return lamba.Compile().Invoke();
        }

        public static void SetPropertyValue<T>(this Expression<Func<T>> lamba, T value)
        {
            //Converts a lamba () => some.Property, to some.Property 
            var expression = (lamba as LambdaExpression).Body as MemberExpression;

            //Get the property information so we can set it
            var propertyInfo = (PropertyInfo)expression.Member;

            var target = Expression.Lambda(expression.Expression).Compile().DynamicInvoke();

            //Set the property value
            propertyInfo.SetValue(target, value);
        }
    }
}
