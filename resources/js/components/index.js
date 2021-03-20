import Vue from 'vue'
import Card from './Card'
import Child from './Child'
import Button from './Button'
import Checkbox from './Checkbox'
import { HasError, AlertError, AlertSuccess } from 'vform'
import Navigation from "./Navigation"
import Icon from './Icon'

// Components that are registered globaly.
[
  Card,
  Child,
  Button,
  Checkbox,
  HasError,
  AlertError,
  AlertSuccess,
  Navigation,
  Icon,
].forEach(Component => {
  Vue.component(Component.name, Component)
})
